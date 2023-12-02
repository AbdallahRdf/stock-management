const ordersChartContext = document.getElementById("orders-chart");

new Chart(ordersChartContext, {
  type: "line",
  data: {
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
        data: [12, 19, 3, 5, 2, 3, 1, 9, 13, 10, 20, 3],
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
  },
  options: {
    responsive: true,
    scales: {
      y: {
        beginAtZero: true,
        suggestedMax: 30,
      },
    },
  },
});
