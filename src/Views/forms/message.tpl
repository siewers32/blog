<form action="index.php?controller=message&action=addmessage" method="post">
    <h3>New Message</h3>
    <input type="hidden" name="author" value=":author"
    <label for="title">Title</label>
    <input type="text" id="title" name="title">
    <label for="message">Message</label>
    <input type="text" id="message" name="message">
    <input type="submit" name="submit">
</form>