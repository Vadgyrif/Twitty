
<form action="/profile/edit" method="POST" enctype="multipart/form-data">
    <label for="avatar">Завантажити аватарку:</label>
    <input type="file" name="avatar" id="avatar">
    
    <label for="bio">Короткий опис:</label>
    <textarea name="bio" id="bio"></textarea>
    
    <label for="birthdate">Дата народження:</label>
    <input type="date" name="birthdate" id="birthdate">
    
    <input type="submit" value="Оновити профіль">
</form>
