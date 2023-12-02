const nextBtn = document.getElementById("next"); // next button 
const previousBtn = document.getElementById("previous"); // previous button
const currentPage = document.getElementById("page"); // current page number
const tableHeader = document.querySelector("tr"); // table header
const table = document.getElementById("table"); // table
const limitController = document.getElementById("limit"); // the select tag that controlls how many records to show in the table

let pagesCount = 0; // number of pages to toggle between in the table;

const APIEndpoint = "http://localhost/stock-management/app/api/data-service.php";

let limit = Number(limitController.value); // the count of data records to get
let offset = 0; // from where to start
let totalRownsCount = 0; // the total number of rows in the db table;

// checks which button should be disabled;
const shouldBeDisabled = () => {
    if (pagesCount <= 1 || currentPage.textContent >= pagesCount) {
      nextBtn.classList.add("disabled");
    } else {
      nextBtn.classList.remove("disabled");
    }

    if (currentPage.textContent == 1 || offset === 0) {
        previousBtn.classList.add("disabled");
    } else {
        previousBtn.classList.remove("disabled");
    }
}

shouldBeDisabled();

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
    
    totalRownsCount = await fetchData(URL); // fetching data (rows count);

    pagesCount = totalRownsCount / limit; // get the number of pages;

    // after getting how many pages we have, if we only have one then make the next button disabled;
    shouldBeDisabled();
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
    button.style.marginRight = "3px";
    button.style.marginLeft = "3px";
    
    // creating the image that will be in action button;
    const img = document.createElement("img");
    img.src = imgURL;
    img.alt = imgAlt;

    button.appendChild(img);

    return button;
}

// when hover over a table row, we add some style to its action buttons;
const handleMouseEnter = (e) => {
    const actionsBtnTd = e.target.children[e.target.children.length-1];
    for(btn of actionsBtnTd.children)
    {
        switch(btn.id)
        {
            case "delete-btn": btn.classList.add("danger"); break;
            case "modify-btn": btn.classList.add("success"); break;
            case "info-btn": btn.classList.add("info"); break;
        }
    }
}

// when hover over a table row, we add some style to its action buttons;
const handleMouseLeave = (e) => {
    const actionsBtnTd = e.target.children[e.target.children.length-1];
    for(btn of actionsBtnTd.children)
    {
        switch(btn.id)
        {
            case "delete-btn": btn.classList.remove("danger"); break;
            case "modify-btn": btn.classList.remove("success"); break;
            case "info-btn": btn.classList.remove("info"); break;
        }
    }
}

// adding event listener to the table rows;
const rowEventListener = () => {
    const tableRows = table.children[1].children; // selecting table rows;

    for(tr of tableRows) // adding event listener to table rows;
    {
        tr.addEventListener("mouseleave", (e) => handleMouseLeave(e));
        tr.addEventListener("mouseenter", e => handleMouseEnter(e));
    }
}

rowEventListener(); // invoking the function;

// update the table content;
const updateTable = (data) => {

    table.innerHTML = ""; // delete table's children, making it empty;

    table.appendChild(tableHeader); // append to the table the header;

    const tableHeaderText = [...tableHeader.children].map(th => th.innerText); // get the text in the <td> tags;
    
    const indexOfDescription = tableHeaderText.indexOf("Description"); // get the index of the "Description" column;

    const tbody = document.createElement("tbody"); // creatig <tbody>

    table.appendChild(tbody);

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

        const updateButton = createActionButton("modify-btn", "modify-btn", id, "modify", "../../img/update.svg", "modify icon");

        const deleteButton = createActionButton("delete-btn", "delete-btn", id, "delete", "../../img/delete.svg", "delete icon");

        const viewName = getViewName();

        if(["products", "orders", "orderedProducts"].indexOf(viewName) !== -1)
        {
            const infoLink = document.createElement("a");

            const controller = "ProductController";

            if (viewName === "orders") {
                controller = "OrderController";
            } else if (viewName === "orderedProducts") {
                controller = "OrderedProdsController";
            }
            infoLink.href = `../../../controllers/${controller}.php?info=${id}`;
            infoLink.classList.add("info-btn");
            infoLink.setAttribute("id", "info-btn");
            infoLink.title = "info";

            // creating the image that will be in action button;
            const img = document.createElement("img");
            img.src = "../../img/info.svg";
            img.alt = "info icon";

            infoLink.appendChild(img);
            td.appendChild(infoLink);
        }

        td.appendChild(updateButton);
        td.appendChild(deleteButton);

        tr.appendChild(td);

        tbody.appendChild(tr);

        if(i === data.length - 1) { // if this is the last row in the table then add to each td tag a "last" class;
            td.classList.add("last");
        }
    }
    rowEventListener(); //adding event listner to the table rows;
}

// scrolls to top
const scrollUp = () => window.scrollTo({top: 0, left: 0, behavior: "smooth"});

const getTableDataAndUpdateIt = async (offset, limit) => {

    const data = await getTableData(offset, limit); // data is an array containing other objects

    const arrayOfData = data.map((item) => Object.values(item)); // turning it into an array of arrays so that we can loop over it simultaneously with the table rows.

    updateTable(arrayOfData); 

    shouldBeDisabled();

    scrollUp(); // when table is updated, this function scrolls to the top of it;
}

const handleNext = async () => {

    if(currentPage.textContent < pagesCount) // if next button is not disabled
    {
        currentPage.textContent++; // increment the current page;

        offset += limit; // increment the offset;
    
        getTableDataAndUpdateIt(offset, limit); // getting table data, then updating it;

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
    
        getTableDataAndUpdateIt(offset, limit); // getting table data, then updating it;

        if(nextBtn.classList.contains("disabled"))
        {
            nextBtn.classList.remove("disabled");
        }
    }
}

const handleLimitChange = async () => {

    limit = Number(limitController.value); // updating the limit of records to show
    offset = 0; // making the offset to 0;
    currentPage.textContent = 1; // updating the current page to be the first;

    getTableDataAndUpdateIt(offset, limit); // getting table data, then updating it;

    pagesCount = totalRownsCount / limit; // get the number of pages;
}

nextBtn.addEventListener("click", handleNext);

previousBtn.addEventListener("click", handlePrevious);

limitController.addEventListener("change", handleLimitChange);