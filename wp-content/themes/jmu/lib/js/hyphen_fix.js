var elements = document.getElementsByTagName("p");

for (var i = 0; i < elements.length; i++)
{
    elements[i].innerHTML = elements[i].innerHTML.replace(/–/g, '&#8209;');   
}