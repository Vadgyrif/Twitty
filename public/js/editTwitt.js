"use strict"

console.log('HELLLLOOOOO');


document.querySelectorAll('.edit-btn').forEach(function(button){
    button.addEventListener("click", function(){
        const id = this.getAttribute('data-id');
        const form = document.getElementById('edit-form-' + id);
        form.style.display = (form.style.display === 'none') ? 'block' : 'none';
    });
});




function saveTwitt(id){
    const newContent = document.getElementById('edit-twitt-' + id).value;

    console.log("Saving twitt ID:", id, "Content:", newContent); // Додайте це для перевірки

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/twitt/update", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function(){
        if(xhr.status === 200){
            document.getElementById('tweet-content-' + id).innerText = newContent;
            document.getElementById('edit-form-' + id).style.display = 'none';
        } else {
            alert(xhr.responseText);
        }
    };

    xhr.send("twitt_id=" + id + "&twitt=" + encodeURIComponent(newContent));
}

