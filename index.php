<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <script>
        function addQuestion() {
            let container = document.getElementById('questions-container');
            let index = container.children.length + 1;
            let html = `
                <div class="question">
                    <h4>Question ${index}</h4>
                    <input type="text" name="questions[${index}][question_text]" placeholder="Enter question" required><br>
                    <input type="text" name="questions[${index}][answer1]" placeholder="Answer 1" required>
                    <input type="text" name="questions[${index}][answer2]" placeholder="Answer 2" required>
                    <input type="text" name="questions[${index}][answer3]" placeholder="Answer 3" required>
                    <input type="text" name="questions[${index}][answer4]" placeholder="Answer 4" required><br>
                    <label>Correct Answer:</label>
                    <select name="questions[${index}][correct_answer]">
                        <option value="1">Answer 1</option>
                        <option value="2">Answer 2</option>
                        <option value="3">Answer 3</option>
                        <option value="4">Answer 4</option>
                    </select>
                </div>
                <hr>
            `;
            container.innerHTML += html;
        }
    </script>

</head>

<body>
  

  <!DOCTYPE html>
<html lang="en">
<head>
    


    <h2>Upload Video & Questions</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label>Video:</label>
        <input type="file" name="video" required><br>

        <label>Description:</label>
        <textarea name="description" required></textarea><br>

        <div id="questions-container">
            <!-- Questions will be added here -->
        </div>

        <button type="button" onclick="addQuestion()">Add Question</button><br>
        <button type="submit">Upload</button>
    </form>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>