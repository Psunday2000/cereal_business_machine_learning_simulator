import Chart from 'chart.js/auto';

// Set global font settings
Chart.defaults.font.family = "'Montserrat', sans-serif";
Chart.defaults.font.style = 'normal';
Chart.defaults.font.weight = 'normal';
// Chart.defaults.font.lineHeight = 1.2;

// Product Price Chart
const ctx = document.getElementById('productPricesChart').getContext('2d');

new Chart(ctx, {
  type: 'bar',
  data: {
    labels: productNames,
    datasets: [{
      label: 'Price',
      data: productPrices,
      backgroundColor: [
        'rgba(255, 99, 132, 0.5)',  // Red
        'rgba(54, 162, 235, 0.5)',  // Blue
        'rgba(255, 206, 86, 0.5)',  // Yellow
        'rgba(75, 192, 192, 0.5)',  // Green
        'rgba(153, 102, 255, 0.5)'  // Purple
      ],
      borderWidth: 1,
      barPercentage: 0.6,
      categoryPercentage: 0.8 
    }]
  },
  options: {
    plugins: {
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

// Line Chart for Age Distribution
const ctx2 = document.getElementById('customerAgeDistro').getContext('2d');

new Chart(ctx2, {
  type: 'line',
  data: {
    labels: ageGroups.map(group => group.label),
    datasets: [{
      label: 'Age Group',
      data: ageGroups.map(group => group.count),
      backgroundColor: 'rgba(54, 162, 235, 0.2)',
      borderColor: 'rgba(54, 162, 235, 1)',
      borderWidth: 1
    }]
  },
  options: {
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
    },
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});

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
    plugins:{
      title: {
          display: true,
          text: 'Customer State Distribution',
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
};

new Chart(ctx3, config);


// Calculate the count of customers for each gender group
const genderCounts = customerGender.reduce((gcc, gender) => {
  gcc[gender] = gcc[gender] ? gcc[gender] + 1 : 1;
  return gcc;
}, {});

// Customer Gender Chart
const ctx4 = document.getElementById('customerGenderChart').getContext('2d');

new Chart(ctx4, {
  type: 'bar',
  data: {
    labels: Object.keys(genderCounts),
    datasets: [{
      label: 'Gender',
      data: Object.values(genderCounts),
      backgroundColor: [
        'rgba(255, 159, 64, 0.5)',
        'rgba(153, 102, 255, 0.5)',
      ],
      borderWidth: 1
    }]
  },
  options: {
    plugins: {
      title: {
        display: true,
        text: 'Customer Gender Distribution',
        font: {
          size: 16
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
    },
    barPercentage: 0.5,
    categoryPercentage: 0.5
  }
});

// Calculate the count of customers for each feedback response
const feedbackCounts = customerFeedback.reduce((fcc, feedback) => {
  fcc[feedback] = fcc[feedback] ? fcc[feedback] + 1 : 1;
  return fcc;
}, {});

// Customer Feedback Chart
const ctx5 = document.getElementById('customerFeedbackChart').getContext('2d');

  new Chart(ctx5, {
    type: 'bar',
    data: {
      labels: Object.keys(feedbackCounts),
      datasets: [{
        label: 'Feedbacks ',
        data: Object.values(feedbackCounts),
        backgroundColor: [
          'rgba(255, 99, 132, 0.5)',
          'rgba(255, 206, 86, 0.5)',
          'rgba(153, 102, 255, 0.5)',
        ],
        borderWidth: 1
      }]
    },
    options: {
        plugins:{
            title: {
                display: true,
                text: 'Customer Feedback Distribution',
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
      },
      barPercentage: 0.5,
      categoryPercentage: 0.5 
    }
  });


// Calculate the count of customers for each health response
const healthCounts = customerHealthImprovement.reduce((fcc, feedback) => {
  fcc[feedback] = fcc[feedback] ? fcc[feedback] + 1 : 1;
  return fcc;
}, {});

// Customer Health Improvement Chart
const ctx6 = document.getElementById('customerHealthChart').getContext('2d');

  new Chart(ctx6, {
    type: 'bar',
    data: {
      labels: Object.keys(healthCounts),
      datasets: [{
        label: 'Health Improvement ',
        data: Object.values(healthCounts),
        borderWidth: 1,
        backgroundColor: [
          'rgba(75, 192, 192, 0.5)',
          'rgba(153, 102, 255, 0.5)',
          'rgba(255, 159, 64, 0.5)'
        ],
      }]
    },
    options: {
        plugins:{
            title: {
                display: true,
                text: 'Customer Health Distribution',
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
      },
      barPercentage: 0.5,
      categoryPercentage: 0.5
    }
  });

// Stock Year Bar Chart
const ctxy = document.getElementById('stockYearLineChart').getContext('2d');

new Chart(ctxy, {
  type: 'bar',
  data: chartDataQuantityProduced,
  options: {
    plugins: {
      title: {
        display: true,
        text: 'Cereal Production Per Year',
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

// Stock Year Bar Chart
const ctxs = document.getElementById('stockSalesBarChart').getContext('2d');

new Chart(ctxs, {
  type: 'bar',
  data: chartDataQuantitySold,
  options: {
    plugins: {
      title: {
        display: true,
        text: 'Sales Per Year',
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

