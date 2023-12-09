document.addEventListener("DOMContentLoaded", function() {
    // Fetch data from the PHP script (replace "tree.php" with your actual script path)
    fetch("getgenology1.php")
        .then(response => response.json())
        .then(data => {
            const treeContainer = document.getElementById("tree");
            const treeData = organizeTreeData(data);

            // Generate the directory tree
            generateTree(treeData, treeContainer);

            // Add event listeners to expand/collapse nodes
            treeContainer.addEventListener("click", function(event) {
                if (event.target.classList.contains("collapsible")) {
                    event.target.classList.toggle("expanded");
                }
            });
        })
        .catch(error => console.error(error));

    // Function to organize the data into a tree structure
    function organizeTreeData(data) {
        return data.map(item => {
            if (item.children && item.children.length > 0) {
                item.children = organizeTreeData(item.children);
            }
            return item;
        });
    }

    // Function to generate the directory tree recursively
    function generateTree(data, container) {
        data.forEach(item => {
            const listItem = document.createElement("li");
            if (item.children && item.children.length > 0) {
                listItem.innerHTML = `<span class="collapsible">[${item.membercode}] ${item.mname}</span>`;
                const sublist = document.createElement("ul");
                listItem.appendChild(sublist);
                generateTree(item.children, sublist);
                listItem.classList.add("folder");
            } else {
                listItem.textContent = item.mname;
            }
            container.appendChild(listItem);
        });
    }
});
