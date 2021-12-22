let compteur = 0;
let timer, elements, slides, slidewidth;
const retour = document.querySelector(".retour");

window.onload = () => {
    const carouselle = document.querySelector(".carouselle");
    elements = document.querySelector(".elements");
    slides = Array.from(elements.children);
    
    slidewidth = carouselle.getBoundingClientRect().width;

    let next = document.querySelector(".fleche-droite");
    let prev = document.querySelector(".fleche-guauche");

    next.addEventListener("click", slidenext);
    prev.addEventListener("click", slideprev);

    timer = setInterval(slidenext, 4000);

    window.addEventListener("resize", () =>{
        slidewidth = carouselle.getBoundingClientRect().width;
    })
}   

function slidenext(){
    
    compteur++
    if(compteur == slides.length){
        compteur = 0;
    }
    let decal = -slidewidth * compteur
    elements.style.transform = `translateX(${decal}px)`;
    
} 

function slideprev(){

    compteur--
    if(compteur < 0){
        compteur.slides.length -1
    }
    let decal = -slidewidth * compteur
    elements.style.transform = `translateX(${decal}px)`;
}

window.onscroll = function() {
    if(document.documentElement.scrollTop > 80) {
        document.querySelector("header").style.background = "rgba(63, 58, 58, 0.8)";
        document.querySelector('.a1').style.color = "white";
        document.querySelector('.a2').style.color = "white";
        document.querySelector('.a3').style.color = "white";
    }
    else{
        document.querySelector("header").style.background = "#f1f1f1";
        document.querySelector('.a1').style.color = "black";
        document.querySelector('.a2').style.color = "black";
        document.querySelector('.a3').style.color = "black";
    }
    if(document.documentElement.scrollTop > 300) {
        retour.style.display =" block";
    }
    else{
        retour.style.display = "none";
    }
}

retour.addEventListener('click', () =>{
    window.scrollTo({
        top: 0,
        left: 0,
        behavior: "smooth"
    })
})

