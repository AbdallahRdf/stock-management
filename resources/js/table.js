const nextBtn = document.getElementById("next");

nextBtn.addEventListener("click", async () => {
  try {
    const response = await fetch(
      "http://localhost/stock-management/app/api/test.php"
    );

    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }

    const data = await response.json(); // Parse the response as JSON

    console.log("Data received:", data);

  } catch (error) {
    console.error("Error:", error);
  }
});
