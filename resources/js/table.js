const nextBtn = document.getElementById("next"); // next button 
const previousBtn = document.getElementById("previous"); // previous button
const currentPage = document.getElementById("page"); // current page number
const tableHeader = document.querySelector("tr"); // table header
const table = document.getElementById("table"); // table

let pagesCount = 0; // number of pages to toggle between in the table;

const APIEndpoint = "http://localhost/stock-management/app/api/data-service.php";

let limit = 10; // the count of data records to get
let offset = 0; // from where to start

// if we are in the first page then make the previousBtn disabled;
if (offset === 0) {
  previousBtn.classList.add("disabled");
}
// after getting how many pages we have, if we only have one then make the next button disabled;
setTimeout(() => {
    if(pagesCount <= 1)
    {
        nextBtn.classList.add("disabled");
    }
}, 200);

// returns the view name (for example: categories, products ...);
const getViewName = () => {
    const arr = document.URL.split("/"); // split the url
    const fileName = arr[arr.length - 1]; // get the last element, which is the "file.php"
    const viewName = fileName.split(".")[0]; // get the file/view name whithout the extension ".php";
    return viewName;
}

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
}

// it get how many rows are there in a db table, and devide it on the limit, to get how much pages we have to to toggle between in the table;
(async () => {
    const viewName = getViewName(); // get the view name

    const URL = APIEndpoint+`?viewName=${viewName}`; // the url;
    
    const data = await fetchData(URL); // fetching data (rows count);

    pagesCount = data / limit; // get the number of pages;
})();

// fetches the table data
const getTableData = async (offset, limit) => {

    const viewName = getViewName();

    const URL = APIEndpoint+`?viewName=${viewName}&offset=${offset}&limit=${limit}`;

    return await fetchData(URL);
}

// update the table content
const updateTable = (data) => {

    table.innerHTML = ""; // delete table's children, making it empty;

    table.appendChild(tableHeader); // append to the table the header;

    for (let i = 0; i < data.length; i++) // creating rows depending on how many data records we have
    {
        const tr = document.createElement("tr"); // create a table row;

        const id = data[i].shift(); // get the id of the element to make the value of the update and delete buttons

        for(let j = 0; j < data[i].length; j++) // looping trough <td> in each row, except the last td;
        {
            const td = document.createElement("td");
            const p = document.createElement("p");
            tr.appendChild(td);
            td.appendChild(p);
            p.textContent = data[i][j];
        }
        const td = document.createElement("td");

        // creating update button
        const updateButton = document.createElement("button");
        updateButton.classList.add("modify-btn");
        updateButton.setAttribute("id", "modify-btn");
        updateButton.value = id;
        updateButton.setAttribute("title", "modify");

        // creating the image that will be in update button;
        const updateIcon = document.createElement("img");
        updateIcon.src = "../../img/write-svgrepo-com.svg";
        updateIcon.alt = "modify icon";

        updateButton.appendChild(updateIcon);

        // creating update button
        const deleteButton = document.createElement("button");
        deleteButton.classList.add("delete-btn");
        deleteButton.setAttribute("id", "delete-btn");
        deleteButton.value = id;
        deleteButton.setAttribute("title", "delete");

        // creating the image that will be in update button;
        const deleteIcon = document.createElement("img");
        deleteIcon.src = "../../img/delete.svg";
        deleteIcon.alt = "delete icon";

        deleteButton.appendChild(deleteIcon);

        td.appendChild(updateButton);
        td.appendChild(deleteButton);
        tr.appendChild(td);

        table.appendChild(tr);
    }
        
    // for (let i = 0; i < tableRowsArray.length; i++) // looping trough table rows
    // {
    //     const tr = tableRowsArray[i]; // current row in table;

    //     const id = data[i].shift(); // get the id of the element to make the value of the update and delete buttons

    //     for(let j = 0; j <  tr.children.length - 1; j++) // looping trough <td> in each row, except the last td;
    //     {
    //         const td = tr.children[j]; // the table data <td>
    //         const p = td.childNodes[1]; // the <p> inside the <td>
    //         p.textContent = data[i][j]; // update the <p> content;
    //     }
    //     const lastTd = tr.children[tr.children.length-1]; //last td in each row;

    //     for(let k = 0; k < lastTd.children.length; k++) // looping through the action buttons in table, to update the id;
    //     {
    //         lastTd.children[k].value = id;
    //     }
    // }
}

const handleNext = async () => {

    // if(!nextBtn.hasAttribute("disabled")) // if next button is not disabled
    if(currentPage.textContent < pagesCount) // if next button is not disabled
    {
        currentPage.textContent++; // increment the current page;

        offset += limit; // increment the offset;
    
        const data = await getTableData(offset, limit); // data is an array containing other objects

        const arrayOfData = data.map((item) => Object.values(item)); // turning it into an array of arrays so that we can loop over it simultaneously with the table rows.

        updateTable(arrayOfData); 

        if(currentPage.textContent == pagesCount)
        {
            nextBtn.classList.add("disabled");
        }
        if(previousBtn.classList.contains("disabled"))
        {
            previousBtn.classList.remove("disabled");
        }
    }
}

const handlePrevious = async () => {

    if(currentPage.textContent > 1) 
    {
        currentPage.textContent--; // decrement the current page;

        offset -= limit;
    
        const data = await getTableData(offset, limit); // data is an array containing other objects

        const arrayOfData = data.map((item) => Object.values(item)); // turning it into an array of arrays so that we can loop over it simultaneously with the table rows.

        updateTable(arrayOfData); 

        if(currentPage.textContent == 1)
        {
            previousBtn.classList.add("disabled");
        }
        if(nextBtn.classList.contains("disabled"))
        {
            nextBtn.classList.remove("disabled");
        }
    }
}

nextBtn.addEventListener("click", handleNext);

previousBtn.addEventListener("click", handlePrevious);