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

    // after getting how many pages we have, if we only have one then make the next button disabled;
    if (pagesCount <= 1) {
      nextBtn.classList.add("disabled");
    }
})();

// fetches the table data
const getTableData = async (offset, limit) => {

    const viewName = getViewName();

    const URL = APIEndpoint+`?viewName=${viewName}&offset=${offset}&limit=${limit}`;

    return await fetchData(URL);
}

// creates the action button like the update button, and delete button;
const createActionButton = (btnClass, btnId, recordId, title, imgURL, imgAlt) => {
    // creating action button
    const button = document.createElement("button");
    button.classList.add(btnClass);
    button.setAttribute("id", btnId);
    button.value = recordId;
    button.setAttribute("title", title);

    // creating the image that will be in action button;
    const img = document.createElement("img");
    img.src = imgURL;
    img.alt = imgAlt;

    button.appendChild(img);

    return button;
}

// update the table content;
const updateTable = (data) => {

    table.innerHTML = ""; // delete table's children, making it empty;

    table.appendChild(tableHeader); // append to the table the header;

    const tableHeaderText = [...tableHeader.children].map(th => th.innerText); // get the text in the <td> tags;
    
    const indexOfDescription = tableHeaderText.indexOf("Description"); // get the index of the "Description" column;

    for (let i = 0; i < data.length; i++) // creating rows depending on how many data records we have;
    {
        const tr = document.createElement("tr"); // create a table row;

        const id = data[i].shift(); // get the id of the element to make the value of the update and delete buttons;

        for(let j = 0; j < data[i].length; j++) // looping trough <td> in each row, except the last td;
        {
            const td = document.createElement("td");
            const p = document.createElement("p");
            tr.appendChild(td);
            td.appendChild(p);
            p.textContent = data[i][j];
            if(indexOfDescription === j) { // if this is the description column then make it hidden;
                td.style.display = "none";
            }
            if (i === data.length - 1) { // if this is the last row in the table then add to each td tag a "last" class;
              td.classList.add("last");
            }
        }
        const td = document.createElement("td");

        const updateButton = createActionButton("modify-btn", "modify-btn", id, "modify", "../../img/write-svgrepo-com.svg", "modify icon");

        const deleteButton = createActionButton("delete-btn", "delete-btn", id, "delete", "../../img/delete.svg", "delete icon");

        td.appendChild(updateButton);
        td.appendChild(deleteButton);
        tr.appendChild(td);

        table.appendChild(tr);

        if(i === data.length - 1) { // if this is the last row in the table then add to each td tag a "last" class;
            td.classList.add("last");
        }
    }
}

// scrolls to top
const scrollUp = () => window.scrollTo({top: 0, left: 0, behavior: "smooth"});

const handleNext = async () => {

    if(currentPage.textContent < pagesCount) // if next button is not disabled
    {
        currentPage.textContent++; // increment the current page;

        offset += limit; // increment the offset;
    
        const data = await getTableData(offset, limit); // data is an array containing other objects

        const arrayOfData = data.map((item) => Object.values(item)); // turning it into an array of arrays so that we can loop over it simultaneously with the table rows.

        updateTable(arrayOfData); 

        if(currentPage.textContent >= pagesCount)
        {
            nextBtn.classList.add("disabled");
        }
        if(previousBtn.classList.contains("disabled"))
        {
            previousBtn.classList.remove("disabled");
        }
        // when table is updated, this function scrolls to the top of it;
        scrollUp();
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
        // when table is updated, this function scrolls to the top of it;
        scrollUp();
    }
}

nextBtn.addEventListener("click", handleNext);

previousBtn.addEventListener("click", handlePrevious);