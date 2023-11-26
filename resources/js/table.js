const nextBtn = document.getElementById("next");
const previousBtn = document.getElementById("previous");
const currentPage = document.getElementById("page");

let limit = 2; // the count of data records to get
let offset = limit; // from where to start

// returns the view name (for example: categories, products ...);
const getViewName = () => {
    const arr = document.URL.split("/"); // split the url
    const fileName = arr[arr.length - 1]; // get the last element, which is the "file.php"
    const viewName = fileName.split(".")[0]; // get the file/view name whithout the extension ".php";
    return viewName;
}

// fetches the data
const fetchData = async (offset, limit) => {

    const viewName = getViewName();

    const URL = `http://localhost/stock-management/app/api/test.php?viewName=${viewName}&offset=${offset}&limit=${limit}`;

    try {
        const response = await fetch(URL);

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json(); // Parse the response from JSON to a js object

        console.log("Data received:", data);

        return data;

    } catch (error) {
        console.error("Error:", error);
    }
}

const handleNext = async () => {

    offset += limit;

    const data = await fetchData(offset, limit);
}

nextBtn.addEventListener("click", handleNext);
