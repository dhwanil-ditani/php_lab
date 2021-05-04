<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Practical 7</title>
        <style>
            .tab {
                overflow: hidden;
                border: 1px solid #ccc;
                background-color: #f1f1f1;
            }
            .tab button {
                background-color: inherit;
                float: left;
                border: none;
                outline: none;
                cursor: pointer;
                padding: 14px 16px;
                transition: 0.3s;
            }
            .tab button:hover {
                background-color: #ddd;
            }
            .tab button.active {
                background-color: #ccc;
            }
            .tabcontent {
                display: none;
                padding: 6px 12px;
                border: 1px solid #ccc;
                border-top: none;

            }
        </style>
        <script type="text/javascript">
            function opentab(element) {
                var i, tabcontent, tablink;
                tabcontent = document.getElementsByClassName("tabcontent");
                tablink = document.getElementsByClassName("tablink");
                for (i=0; i<tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                for (i=0; i<tablink.length; i++) {
                    tablink[i].classList.remove("active");
                }
                document.getElementById(element.name).style.display = "block";
                element.classList.add("active");
            }
        </script>
    </head>
    <body>

        <div class="tab">
            <button type="button" name="add_category">Add Category</button>
            <button type="button" name="del_category">Delete Category</button>
            <button type="button" name="update_category">Update Category</button>
            <button type="button" name="disp_category">Display All Category</button>
            <button type="button" name="add_item_details">Add Item Details</button>
            <button type="button" name="del_item_details">Delete Item Details</button>
            <button type="button" name="update_item_details">Update Item Details</button>
        </div>

        <div class="tabcontent">
            
        </div>


    </body>
</html>
