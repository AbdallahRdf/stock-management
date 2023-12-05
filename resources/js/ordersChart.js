const APIEndpoint = "http://localhost/stock-management/app/api/dashboard-api.php";

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

// get the orders count and supplier orders count through an api request then update the chart
const getOrdersCount = async (year) => {
  const URL = APIEndpoint + `?model=ordersChart&year=${year}`;

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
const data = {
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
const config = {
  type: "line",
  data,
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
// create and render the chart
const ordersChart = new Chart(document.getElementById("orders-chart"), config);
// update the chart;
getOrdersCount((new Date()).getFullYear());
// add eent listener to the select year;
document.getElementById("year-select").addEventListener("change", e => getOrdersCount(e.target.value));