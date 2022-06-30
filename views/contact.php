<h1>Contact</h1>
<h5><?php echo $name; ?></h5>

<form action="" method="post">
    <div>
        <label>Name:</label>
        <input type="text" name="name" id="name">
    </div>
    <br/>

    <div>
        <label>Email:</label>
        <input type="email" name="email" id="email">
    </div>
    <br/>

    <div>
        <label>Subject:</label>
        <input type="text" name="subject" id="subject">
    </div>
    <br/>

    <div>
        <label>Body:</label>
        <textarea name="body" id="body" cols="30" rows="10"></textarea>
    </div>
    <br/>

    <div>
        <button type="submit">Submit</button>
    </div>
</form>