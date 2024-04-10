from flask import Flask, send_from_directory
import mysql.connector
import matplotlib.pyplot as plt
import pandas as pd
import os
import time

app = Flask(__name__)

# MySQL database connection
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="cbmls"
)

def generate_chart():
    # Create a figure with subplots
    fig, axs = plt.subplots(4, 1, figsize=(8, 24))

    # Bar plot for product prices
    cursor = db.cursor()
    cursor.execute("SELECT price FROM products")
    prices = [float(row[0]) for row in cursor.fetchall()]  # Convert to float
    axs[0].boxplot(prices)
    axs[0].set_title('Product Prices Distribution')
    axs[0].set_xlabel('Products')
    axs[0].set_ylabel('Price')

    # Bar plot for customer age distribution
    cursor.execute("SELECT age FROM customers")
    ages = [row[0] for row in cursor.fetchall()]
    axs[1].hist(ages, bins=10, edgecolor='black')
    axs[1].set_title('Customer Age Distribution')
    axs[1].set_xlabel('Age')
    axs[1].set_ylabel('Count')

    # Pie chart for state distribution among customers
    cursor.execute("SELECT state, COUNT(*) FROM customers GROUP BY state")
    state_counts = dict(cursor.fetchall())
    states = list(state_counts.keys())
    counts = list(state_counts.values())
    axs[2].pie(counts, labels=states, autopct='%1.1f%%', startangle=90)
    axs[2].set_title('State Distribution Among Customers')

    # Bar plot for health_improvement
    cursor.execute("SELECT health_improvement FROM customers")
    health_improvements = [row[0] for row in cursor.fetchall()]
    axs[3].hist(health_improvements, bins=5, edgecolor='black')
    axs[3].set_title('Health Improvement Distribution')
    axs[3].set_xlabel('Health Improvement Level')
    axs[3].set_ylabel('Count')

    # Save the plot image
    img_dir = os.path.join('public', 'images', 'charts')
    os.makedirs(img_dir, exist_ok=True)
    img_path = os.path.join(img_dir, 'customer_plots.png')
    plt.tight_layout()
    plt.savefig(img_path)

    return img_path


def check_database_changes():
    last_update_time = 0
    while True:
        cursor = db.cursor()
        cursor.execute("SELECT UNIX_TIMESTAMP()")
        current_time = cursor.fetchone()[0]

        if current_time != last_update_time:
            img_path = generate_chart()
            print(f"Charts updated at: {img_path}")
            last_update_time = current_time

        time.sleep(5)  # Check for changes every 5 seconds

@app.route('/')
def index():
    return "Welcome to the Charts App!"

@app.route('/images/charts/<filename>')
def get_image(filename):
    return send_from_directory('public/images/charts', filename)

if __name__ == '__main__':
    # Start a separate thread to check for database changes
    import threading
    threading.Thread(target=check_database_changes).start()

    # Run the Flask app
    app.run(debug=True)