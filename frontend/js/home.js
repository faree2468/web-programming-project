export function addCharts() {
    const billsCtx = document.getElementById('billsChart');
    const expenseCtx = document.getElementById('expenseIncomeChart');
    const topSpendsCtx = document.getElementById('topSpendsChart');

    if (Chart.getChart(billsCtx)) Chart.getChart(billsCtx).destroy();
    if (Chart.getChart(expenseCtx)) Chart.getChart(expenseCtx).destroy();
    if (Chart.getChart(topSpendsCtx)) Chart.getChart(topSpendsCtx).destroy();
    
    new Chart(billsCtx, {
        type: 'doughnut',
        data: {
        labels: ['Paid', 'Upcoming'],
        datasets: [{
            label: 'Bills',
            data: [1500, 900],
            backgroundColor: [
                'rgba(0, 247, 21, 1)',
                'rgba(255, 217, 3, 1)'
            ]
        }]
        },
        options: {
        scales: {
            x: {
                display: false,
                grid: {
                    display: false,
                }
            },
            y: {
                display: false,
                grid: {
                    display: false,
                    
                }
            },    
        }
        }
    });

    new Chart(expenseCtx, {
        type: 'doughnut',
        data: {
        labels: ['Expense', 'Income'],
        datasets: [{
            label: 'Expense vs Income',
            data: [1100, 900],
            backgroundColor: [
                'rgba(247, 8, 0, 1)',
                'rgba(0, 247, 21, 1)'
            ]
        }]
        },
        options: {
        scales: {
            x: {
                display: false,
                grid: {
                    display: false,
                }
            },
            y: {
                display: false,
                grid: {
                    display: false,
                    
                }
            },    
        }
        }
    });

    new Chart(topSpendsCtx, {
        type: 'pie',
        data: {
        labels: ['Housing', 'Utilities'], // this data will be dynamically added, labels, data
        datasets: [{
            label: 'Top spends',
            data: [1100, 900],
            backgroundColor: [
                'rgba(0, 218, 247, 1)',
                'rgba(45, 0, 247, 1)',

            ]
        }]
        },
        options: {
        scales: {
            x: {
                display: false,
                grid: {
                    display: false,
                }
            },
            y: {
                display: false,
                grid: {
                    display: false,
                    
                }
            },    
        }
        }
    });

    
}

export function personalize() {
    const nameTitle = document.getElementById("welcome-tag");
    var token = localStorage.getItem('user_token');

    if(token && token !== undefined) {
        let parsedToken = Utils.parseJwt(token);
        let addToString = nameTitle.textContent.slice(0, 9);
        addToString += parsedToken.user["name"];
        nameTitle.textContent = addToString;
    }
}