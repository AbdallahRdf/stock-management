const baseURL = "http://localhost/stock-management/app/api/dashboard-api.php";

// fetches data;
const fetchData = async (URL) => {
  try {
    const response = await fetch(URL);

    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }

    return await response.json(); // Parse the response from JSON to a js object
  } catch (error) {
    console.error("Error:", error);
  }
};

// ************** this block handles the orders chart ***************//
// get the orders count and supplier orders count through an api request then update the chart
const getOrdersCount = async (year) => {
  const URL = baseURL + `?chart=ordersChart&year=${year}`;

  const data = await fetchData(URL); // fetching data;

  let max = 0; // will hold the maximum value of Y axis;

  for(let i = 0; i < data.length; i++)
  {
    ordersChart.config.data.datasets[i].data = data[i]; // update data in chart

    max = Math.max(...data[i]) > max ? Math.max(...data[i]) : max;
  }
  ordersChart.config.options.scales.y.suggestedMax = max + 2; // updated the max value of y axis;
  ordersChart.update(); // update the chart;
};

// data object
const ordersData = {
  labels: [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "May",
    "Jun",
    "Jul",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec",
  ],
  datasets: [
    {
      label: "Orders",
      data: [],
      borderWidth: 1,
      borderColor: "#36A2EB",
      tension: 0.4,
      borderWidth: 2,
    },
    {
      label: "Supplier Orders",
      data: [],
      borderWidth: 1,
      borderColor: "#FF6384",
      tension: 0.4,
      borderWidth: 2,
    },
  ],
};
// config object
const ordersConfig = {
  type: "line",
  data: ordersData,
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true,
        suggestedMax: 10,
      },
    },
  },
};
// create and render the orders chart
const ordersChart = new Chart(document.getElementById("orders-chart"), ordersConfig);

// update the chart;
getOrdersCount((new Date()).getFullYear());

// add event listener to the select year in the orders chart;
document.getElementById("orders-year-select").addEventListener("change", e => getOrdersCount(e.target.value));

// ************** this block handles the best selling products chart ***************//

// get the top 5 selling products;
const getTopSellingProducts = async () => {

  const URL = baseURL + "?chart=topSellingProducts"; 

  const data = await fetchData(URL);

  productsChart.config.data.labels = data[0]; // updating lables
  productsChart.config.data.datasets[0].data = data[1]; // updating chart data

  if(data[0].length <= 0){ // if the array is empty then make the y and x axis visible
    productsChart.config.options.scales.x.display = true;
    productsChart.config.options.scales.y.display = true;
  }
  productsChart.update();
}

// data object
const productsData = {
  labels: [],
  datasets: [
    {
      label: "Selled quantity",
      data: [],
      borderWidth: 1,
      backgroundColor: [
        'rgba(75, 192, 192, 0.6)', // green
        'rgba(54, 162, 235, 0.6)', // blue
        'rgba(153, 102, 255, 0.6)', // purple
        'rgba(255, 99, 132, 0.6)', // red
        'rgba(255, 159, 64, 0.6)', // orange
        'rgba(255, 205, 86, 0.6)', // yellow
        'rgba(201, 203, 207, 0.6)', // grey
      ],
      hoverOffset: 8
    }
  ],
};
// config object
const productsConfig = {
  type: "doughnut",
  data: productsData,
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        display: false,
      },
      x: {
        display: false,
      }
    },
  },
};
// create and render the orders chart
const productsChart = new Chart(document.getElementById("best-selling-products-chart"), productsConfig);

getTopSellingProducts();

// ************** this block handles the clients growth chart ***************//

// get the top 5 selling products;
const getTheClientGrowth = async (year) => {

  const URL = baseURL + `?chart=clientsChart&year=${year}`;

  const data = await fetchData(URL);

  clientsChart.config.data.datasets[0].data = data; // updating chart data

  clientsChart.config.options.scales.y.suggestedMax = Math.max(...data) + 2; // updated the max value of y axis;

  clientsChart.update();
}

// data object
const clientsData = {
  labels: [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "May",
    "Jun",
    "Jul",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec",
  ],
  datasets: [
    {
      label: "new clients count",
      data: [],
      borderWidth: 1,
      backgroundColor: [
        'rgba(75, 192, 192, 0.7)',
        'rgba(75, 192, 192, 0.6)',
        'rgba(75, 192, 192, 0.5)',
        'rgba(75, 192, 192, 0.4)',
        'rgba(75, 192, 192, 0.3)',
        'rgba(75, 192, 192, 0.2)',
      ],
      hoverOffset: 8
    }
  ],
};
// config object
const clientsConfig = {
  type: "bar",
  data: clientsData,
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true,
        suggestedMax: 10,
      },
    },
  },
};
// create and render the orders chart
const clientsChart = new Chart(document.getElementById("clients-chart"), clientsConfig);

getTheClientGrowth((new Date()).getFullYear());

// add event listener to the select year in the clients chart;
document.getElementById("clients-year-select").addEventListener("change", e => getTheClientGrowth(e.target.value));