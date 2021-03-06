<script>
// Fetching Data from Database (Live)
function fetch_data() {
    $.ajax({
        url: "resources/library/dataGrid/select.php",
        method: "POST",
        success: function(data) {
            $("#live_data").html(data);
        }
    });
}

// On page reload
$(document).ready(function() {
    fetch_data();
});

// DATE VALIDATION Format (yyyy-mm-dd)
const date_regex = /^((19|20)\d{2})(\/|-)(0[1-9]|1[0-2])(\/|-)(0[1-9]|1\d|2\d|3[01])$/;

// Event action for add Button
$(document).on("click", "#btn_add", function() {
    const activity_name = $("#activity_name").text();
    const project_name = $("#project_name").text();
    const projected_start_date = $("#projected_start_date").text();
    const projected_end_date = $("#projected_end_date").text();
    const actual_start_date = $("#actual_start_date").text();
    const actual_end_date = $("#actual_end_date").text();
    const projected_days = $("#projected_days").text();
    const actual_days = $("#actual_days").text();
    const accuracy = $("#accuracy").text();
    const score = $("#score").text();
    const stat = $("#stat").text();
    
    // Field Validation after button click
    if(activity_name == "") {
        alert("Enter a Activity");
        return false;
    }
    if(project_name == "") {
        alert("Enter Project Name");
        return false;
    }
    if(score == "") {
        alert("Enter Activity Score");
        return false;
    }

    if(projected_start_date != "" && !(date_regex.test(projected_start_date))) {
        alert("Enter Date in yyyy-mm-dd format");
        return false;
    }
    if(projected_end_date != "" && !(date_regex.test(projected_end_date))) {
        alert("Enter Date in yyyy-mm-dd format");
        return false;
    }

    if(actual_start_date != "" && !(date_regex.test(actual_start_date))) {
        alert("Enter Date in yyyy-mm-dd format");
        return false;
    }
    if(actual_end_date != "" && !(date_regex.test(actual_end_date))) {
        alert("Enter Date in yyyy-mm-dd format");
        return false;
    }

    // Insert data if all ok
    $.ajax({
        url: "resources/library/dataGrid/insert.php",
        method: "POST",
        data: {
            activity_name: activity_name,
            project_name: project_name,
            projected_start_date: projected_start_date,
            projected_end_date: projected_end_date,
            actual_start_date: actual_start_date,
            actual_end_date: actual_end_date,
            projected_days: projected_days,
            actual_days: actual_days,
            accuracy: accuracy,
            score: score,
            stat: stat
        },
        dataType: "text",
        success: function(data) {
            $("#result").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>×</button><strong>" + data + "</strong></div>");

            fetch_data();
        }
    });
});

// Edit existing data
function edit_data(id, text, column_name) {
    $.ajax({
        url: "resources/library/dataGrid/edit.php",
        method: "POST",
        data: {
            id: id,
            text: text,
            column_name: column_name
        },
        dataType: "text",
        success: function(data) {
            $('#result').html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>×</button><strong>" + data + "</strong></div>");

            fetch_data();
        }
    });
}

// On event actions for data grids
$(document).on("blur", ".activity_name", function() {
    const id = $(this).data("id1");
    const activity_name = $(this).text();

    edit_data(id, activity_name, "activity_name");
});

$(document).on("blur", ".project_name", function() {
    const id = $(this).data("id2");
    const project_name = $(this).text();

    edit_data(id, project_name, "project_name");
});

$(document).on("blur", ".projected_start_date", function() {
    const id = $(this).data("id3");
    const projected_start_date = $(this).text();

    if(projected_start_date != "" && !(date_regex.test(projected_start_date))) {
        alert("Enter Date in yyyy-mm-dd format");
        return false;
    }

    edit_data(id, projected_start_date, "projected_start_date");
});

$(document).on("blur", ".projected_end_date", function() {
    const id = $(this).data("id4");
    const projected_end_date = $(this).text();

    if(projected_end_date != "" && !(date_regex.test(projected_end_date))) {
        alert("Enter Date in yyyy-mm-dd format");
        return false;
    }

    edit_data(id, projected_end_date, "projected_end_date");
});

$(document).on("blur", ".actual_start_date", function() {
    const id = $(this).data("id5");
    const actual_start_date = $(this).text();

    if(actual_start_date != "" && !(date_regex.test(actual_start_date))) {
        alert("Enter Date in yyyy-mm-dd format");
        return false;
    }

    edit_data(id, actual_start_date, "actual_start_date");
});

$(document).on("blur", ".actual_end_date", function() {
    const id = $(this).data("id6");
    const actual_end_date = $(this).text();

    if(actual_end_date != "" && !(date_regex.test(actual_end_date))) {
        alert("Enter Date in yyyy-mm-dd format");
        return false;
    }

    edit_data(id, actual_end_date, "actual_end_date");
});

$(document).on("blur", ".score", function() {
    const id = $(this).data("id10");
    const score = $(this).text();

    edit_data(id, score, "score");
});

// On click event for delete Button
$(document).on("click", ".btn_delete", function() {
    const id = $(this).data("id12");

    if(confirm("Are you sure you want to delete this?")) {
        $.ajax({
            url : "resources/library/dataGrid/delete.php",
            method : "POST",
            data: {
                id: id
            },
            dataType: "text",
            success: function(data) {
                $("#result").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>×</button><strong>" + data + "</strong></div>");

                fetch_data();
            }
        });
    }
});
</script>
