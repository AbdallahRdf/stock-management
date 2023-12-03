const APIEndpoint = "http://localhost/stock-management/app/api/dashboard-api.php";

// returns the view name (for example: categories, products ...);
const getViewName = () => {
  const arr = document.URL.split("/"); // split the url
  const fileName = arr[arr.length - 1]; // get the last element, which is the "file.php"
  const viewName = fileName.split(".")[0]; // get the file/view name whithout the extension ".php";
  return viewName;
};

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

// if there is a month missing in the data array, we put instead a zero value;
const formatDataset = (data) => {
  const formatedData = [];

  for (let i = 0; i < 12; i++) {
    if (data[i]["month(date)"] == i + 1) {
      formatedData.push(data[i]["count(id)"]);
    } else {
      formatedData.push(0);
    }
  }
  return formatedData;
};

// get the orders count through an api request then update the chart
const getOrdersCount = async () => {
  const URL = APIEndpoint + `?viewName=orders&year=${new Date().getFullYear()}`;

  const data = await fetchData(URL);

  ordersChart.config.data.datasets[0].data = formatDataset(data);
  ordersChart.update();
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
      data: [1, 9, 13, 10, 2, 3, 12, 19, 3, 5, 2, 3],
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
        suggestedMax: 30,
      },
    },
  },
};

const ordersChart = new Chart(document.getElementById("orders-chart"), config);

getOrdersCount();