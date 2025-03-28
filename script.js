var int;
function setInt() {
    clearInterval(int);
    int = setInt(function() {
        var buttons = document.getElementsByName("carousel");
        for(var i = 0; i < buttons.length; i++) {
            if(buttons[i].checked) {
                console.log(`Currently on slide: ${i + 1}`);
                buttons[i].checked = false;
                if(i + 1 == buttons.length) {
                    buttons[0].checked = true;
                } else {
                    buttons[i + 1].checked = true;
                }
                return;
            }
        }
    }, 5000); 
}
window.onload = function() {
    setInt();
};