const nextBtn = document.getElementById("next");

nextBtn.addEventListener("click", async () => {

    const arr = document.URL.split("/"); // aplit the url
    const fileName = arr[arr.length - 1]; // get the "file.php"
    const viewName = fileName.split(".")[0]; // get the file/view name
    try {
        const response = await fetch(`http://localhost/stock-management/app/api/test.php?viewName=${viewName}`);

        if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json(); // Parse the response as JSON

        console.log("Data received:", data);

    } catch (error) {
        console.error("Error:", error);
    }
});
