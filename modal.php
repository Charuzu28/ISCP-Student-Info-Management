<div class="outer-container">
<div class="modal-container" >
            <form class="modal-form" action="add-student.php" method="post">
                <h1>Student Form</h1>
                <label for="schoolID">School ID: </label>
                <input type="number" name="schoolID" id="schoolID" placeholder="School ID" required>
                <label for="studentName">Student Name: </label>
                <input type="text" name="studentName" id="studentName" placeholder="Name" required>
                <label for="course">Course: </label>
                <select name="course" id="course" required>
                    <option value="1">BSIT</option>
                    <option value="2">BSCS</option>
                </select>
                <label for="year">Year: </label>
                <input type="text" name="year" id="year"  placeholder="Year" required>
                <br>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
            <button class="btn btn-secondary close-modal" style="margin-top: 10px;">Close</button>        
    </div>
</div>
