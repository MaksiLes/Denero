$(document).on('keydown', function (e) {
    if (e.keyCode === 38) {
        alert("Перехватили нажатие клавиши up arrow")
    }
    if (e.keyCode === 40) {
        alert("Перехватили нажатие клавиши down arrow")
    }
    if (e.keyCode === 37) {
        alert("Перехватили нажатие клавиши left arrow")
    }
    if (e.keyCode === 39) {
        alert("Перехватили нажатие клавиши right arrow")
    }
});




