const nextBtn = document.getElementById("next");
const previousBtn = document.getElementById("previous");
const currentPage = document.getElementById("page");
const tableRows = document.getElementsByTagName("tr");

let limit = 10; // the count of data records to get
let offset = 0; // from where to start

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

        // console.log("Data received:", data);

        return data;

    } catch (error) {
        console.error("Error:", error);
    }
}

// update the table content
const updateTable = (data) => {

    const tableRowsArray = [...tableRows]; // tableRows is an object, let turn it into an array

    tableRowsArray.shift(); // remove the first row, which is the table header;
        
    for (let i = 0; i < tableRowsArray.length; i++) // looping trough table rows
    {
        const tr = tableRowsArray[i]; // current row in table;

        const id = data[i].shift(); // get the id of the element to make the value of the update and delete buttons

        for(let j = 0; j <  tr.children.length - 1; j++) // looping trough <td> in each row, except the last td;
        {
            const td = tr.children[j]; // the table data <td>
            const p = td.childNodes[1]; // the <p> inside the <td>
            p.textContent = data[i][j]; // update the <p> content;
        }
        const lastTd = tr.children[tr.children.length-1]; //last td in each row;

        for(let k = 0; k < lastTd.children.length; k++) // looping through the action buttons in table, to update the id;
        {
            lastTd.children[k].value = id;
        }
    }
}

const handleNext = async () => {

    if(!nextBtn.hasAttribute("disabled")) // if next button is not disabled
    {
        offset += limit;
    
        const data = await fetchData(offset, limit); // data is an object containing other objects

        if(data.length <= 0)
        {
            nextBtn.setAttribute("disabled", "disabled");
            nextBtn.classList.add("disabled") 
        }
        else
        {
            const dataArray = [...data]; // turning it to an array of objects

            const arrayOfData = dataArray.map((item) => Object.values(item)); // turning it into an array of arrays so that we can loop over it simultaneously with the table rows.

            updateTable(arrayOfData); 
        }
        if(previousBtn.classList.contains("disabled"))
    {
        previousBtn.classList.remove("disabled");
    }
    }
}

const handlePrevious = async () => {

    if(offset > 0) 
    {
        offset -= limit;
    
        const data = await fetchData(offset, limit); // data is an object containing other objects

        const dataArray = [...data]; // turning it to an array of objects

        const arrayOfData = dataArray.map((item) => Object.values(item)); // turning it into an array of arrays so that we can loop over it simultaneously with the table rows.

        updateTable(arrayOfData); 
    }
    else
    {
        previousBtn.classList.add("disabled"); 
    }

    if(nextBtn.classList.contains("disabled"))
    {
        nextBtn.classList.remove("disabled");
    }
}

nextBtn.addEventListener("click", handleNext);

previousBtn.addEventListener("click", handlePrevious);
