// some functions to get data for the dashboard
async function getPaidBills(year, month) {
    try {
        let token = localStorage.getItem('user_token');
        let usr = Utils.parseJwt(token);
        const payments = await PaymentService.getPaymentsFromUserForYearMonth(year, month, usr.user.id);
        let paymentArr = [];
        for(let payment of payments) {
            paymentArr.push(payment.amount);
        }
        return paymentArr;

    } catch(e) {
        console.error(e);
    }
}

async function getTopSpendsByCtg() {
    try {
        let token = localStorage.getItem('user_token');
        let usr = Utils.parseJwt(token);
        const topSpends = CategoryService.getTopSpendsForUser(usr.user.id);
        return topSpends;
    } catch(e) {
        console.error(e);
    }
}

export function setupHomeFilters() {
    const monthSelect = document.getElementById('home-month');
    const yearSelect  = document.getElementById('home-year');
    const homeDateBtn = document.getElementById('home-date-confirm');

    const paidText = document.getElementById('home-paid');
    const incomeText = document.getElementById('home-income');
    const expenseText = document.getElementById('home-expense');
    const leaderboard = document.querySelector('.home-dashboard-topSpends');

    if (!monthSelect || !yearSelect || !homeDateBtn) {
        console.error("Elements not loaded yet");
        return;
    }

    
    getPaidBills(yearSelect.value, monthSelect.value).then((paymentArr)=>{
        let paidSum = paymentArr.reduce((acc, val)=>acc+val, 0);

        let ctgNames = []
        let ctgTotalSpent = []

        paidText.textContent = paidSum;
        incomeText.textContent = localStorage.getItem('user_income') ? localStorage.getItem('user_income') : 0;
        expenseText.textContent = paidSum;

        getTopSpendsByCtg().then((topSpends)=>{
        
            for(let spend of topSpends) {
                leaderboard.innerHTML += `<div class="row"><span>${spend.category_name}</span><span>${spend.total_spent}</span></div>`
                ctgNames.push(spend.category_name);
                ctgTotalSpent.push(spend.total_spent);
            }
            
            addCharts(paidSum, ctgNames, ctgTotalSpent);

        });

        
    });

    

    
    homeDateBtn.addEventListener('click', (e) => {
        e.preventDefault();
        getPaidBills(yearSelect.value, monthSelect.value).then((paymentArr)=>{
            let paidSum = paymentArr.reduce((acc, val)=>acc+val, 0);

            paidText.textContent = paidSum;
            incomeText.textContent = localStorage.getItem('user_income') ? localStorage.getItem('user_income') : 0;
            expenseText.textContent = paidSum;
            
            addCharts(paidSum);
        });
    });
}


function addCharts(paidSum=0, labels=[], labelsData=[]) {
    const billsCtx = document.getElementById('billsChart');
    const expenseCtx = document.getElementById('expenseIncomeChart');
    const topSpendsCtx = document.getElementById('topSpendsChart');

    labelsData = labelsData.map(Number);

    if (Chart.getChart(billsCtx)) Chart.getChart(billsCtx).destroy();
    if (Chart.getChart(expenseCtx)) Chart.getChart(expenseCtx).destroy();
    if (Chart.getChart(topSpendsCtx)) Chart.getChart(topSpendsCtx).destroy();
    
    new Chart(billsCtx, {
        type: 'doughnut',
        data: {
        labels: ['Paid'],
        datasets: [{
            label: 'Bills',
            data: [paidSum],
            backgroundColor: [
                'rgba(0, 247, 21, 1)',
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
            data: [paidSum, localStorage.getItem('user_income') ? localStorage.getItem('user_income') : 0],
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
        labels: labels,
        datasets: [{
            label: 'Top spends',
            data: labelsData,
            backgroundColor: [
                '#1abc9c', '#3498db', '#9b59b6', '#e74c3c', '#f1c40f',
                '#2ecc71', '#34495e', '#e67e22', '#95a5a6'

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


