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
const getOrdersCount = async () => {
  const URL = APIEndpoint + `?model=ordersChart&year=${new Date().getFullYear()}`;

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
      borderColor: "rgb(75, 192, 192)",
      tension: 0.4,
      borderWidth: 2,
    },
    {
      label: "Supplier Orders",
      data: [],
      borderWidth: 1,
      borderColor: "rgb(255, 99, 132)",
      tension: 0.4,
      borderWidth: 2,
    },
  ],
};

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

const ordersChart = new Chart(document.getElementById("orders-chart"), config);

getOrdersCount();
getSupplierOrdersCount();