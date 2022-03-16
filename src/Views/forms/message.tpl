<form action="index.php?controller=message&action=create" method="post">
    <h3>New Message</h3>
    <input type="hidden" name="author" value=":author">
    <label for="title">Title</label>
    <input type="text" id="title" name="title">
    <label for="messagetext">Message</label>
    <textarea id="messagetext" name="messagetext"></textarea>
    <input type="submit" name="submit">
</form>