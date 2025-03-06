document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("deleteBtn").addEventListener("click", function () {
        let packageId = this.getAttribute("data-id");
        
        if (confirm("Are you sure you want to delete this package?")) {
            fetch("delete_packages.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "id=" + packageId
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                window.location.href = "manage_package.php";
            })
            .catch(error => console.error("Error:", error));
        }
    });
});
