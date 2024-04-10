import Chart from 'chart.js/auto';

// Set global font settings
Chart.defaults.font.family = "'Montserrat', sans-serif";
Chart.defaults.font.style = 'normal';
Chart.defaults.font.weight = 'normal';
// Chart.defaults.font.lineHeight = 1.2;

const ctx = document.getElementById('productPricesChart').getContext('2d');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: productNames,
      datasets: [{
        label: 'Price ',
        data: productPrices,
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
        plugins:{
            title: {
                display: true,
                text: 'Product Prices',
                font: {
                    size: 16,
                },
                padding: {
                    top: 10, 
                    bottom: 20
                }
            }
        },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

// Pie Chart for Age Distribution
const ageGroups = Array.from({ length: Math.ceil(Math.max(...customerAges) / 10) }, (_, index) => ({
  label: `${index * 10 + 1}-${(index + 1) * 10}`,
  count: customerAges.filter(age => age >= index * 10 + 1 && age <= (index + 1) * 10).length
}));

const ctx2 = document.getElementById('customerAgeDistro').getContext('2d');

new Chart(ctx2, {
  type: 'pie',
  data: {
      labels: ageGroups.map(group => group.label),
      datasets: [{
          label: 'Age Group',
          data: ageGroups.map(group => group.count),
          backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(240, 128, 128, 0.2)',
              'rgba(0, 206, 209, 0.2)',
              'rgba(255, 69, 0, 0.2)',
              'rgba(255, 140, 0, 0.2)'
          ],
          borderColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(240, 128, 128, 1)',
              'rgba(0, 206, 209, 1)',
              'rgba(255, 69, 0, 1)',
              'rgba(255, 140, 0, 1)'
          ],
          borderWidth: 1
      }]
  },
  options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
          title: {
              display: true,
              text: 'Distribution of Customers Ages',
              font: {
                  size: 16,
              },
              padding: {
                  top: 10,
                  bottom: 20
              }
          }
      }
  }
});

// Pie Chart for State Distribution
// Calculate the count of customers for each state
const stateCounts = customerStates.reduce((acc, state) => {
  acc[state] = acc[state] ? acc[state] + 1 : 1;
  return acc;
}, {});

// Line Chart for State Distribution
const ctx3 = document.getElementById('customerStateChart').getContext('2d');
const data = {
  labels: Object.keys(stateCounts),
  datasets: [{
    label: 'States',
    data: Object.values(stateCounts),
    borderColor: 'rgba(255, 99, 132, 1)',
    borderWidth: 1,
    fill: false
  }]
};

const config = {
  type: 'line',
  data: data,
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
};

new Chart(ctx3, config);
