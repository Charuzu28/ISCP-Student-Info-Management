    <!-- Add Subject Modal -->
    <div class="modal fade" id="addSubjectModal" tabindex="-1" aria-labelledby="addSubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSubjectModalLabel">Add Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="lib/add_subject.php" method="post">
                        <div class="mb-3">
                            <label for="courseCode" class="form-label">Course Code</label>
                            <input type="text" class="form-control" id="courseCode" name="courseCode" required>
                        </div>
                        <div class="mb-3">
                            <label for="subDetails" class="form-label">Subject Details</label>
                            <textarea class="form-control" id="subDetails" name="subDetails" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="prerequisite" class="form-label">Prerequisite</label>
                            <input type="text" class="form-control" id="prerequisite" name="prerequisite" required>
                        </div>
                        <div class="mb-3">
                            <label for="lab" class="form-label">Room</label>
                            <input type="text" class="form-control" id="lab" name="lab" required>
                        </div>
                        <div class="mb-3">
                            <label for="unit" class="form-label">Units</label>
                            <input type="number" class="form-control" id="unit" name="unit" required>
                        </div>
                        <input type="hidden" name="courseID" value="<?php echo htmlspecialchars($courseID); ?>">
                        <input type="hidden" name="studentID" value="<?php echo htmlspecialchars($studentID); ?>">
                        <button type="submit" class="btn btn-primary">Add Subject</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
