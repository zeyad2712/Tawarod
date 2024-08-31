var maincontent = document.getElementById("main-content");
var maincontent1 = document.getElementById("main-content1");
var maincontent2 = document.getElementById("main-content2");
var maincontent3 = document.getElementById("main-content3");

function openRep() {
    maincontent.classList.add('d-none')
    maincontent1.classList.remove('d-none')
    maincontent2.classList.add('d-none')
    maincontent3.classList.add('d-none')
}

function closeRep() {
    maincontent.classList.remove('d-none')
    maincontent1.classList.add('d-none')
    maincontent2.classList.add('d-none')
    maincontent3.classList.add('d-none')
}

function openAdd() {
    maincontent.classList.add('d-none')
    maincontent1.classList.add('d-none')
    maincontent2.classList.remove('d-none')
    maincontent3.classList.add('d-none')
}

function openAdm() {
    maincontent.classList.add('d-none')
    maincontent1.classList.add('d-none')
    maincontent2.classList.add('d-none')
    maincontent3.classList.remove('d-none')
}