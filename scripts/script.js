let URL = `http://127.0.0.1:5000`

let num1 = document.getElementById("num1")
let num2 = document.getElementById("num2")

let n1 = document.getElementById("n1")
let n2 = document.getElementById("n2")
let op = document.getElementById("op")
let ans = document.getElementById("ans")

let add = document.getElementById("add");
let sub = document.getElementById("sub");
let mul = document.getElementById("mul");
let div = document.getElementById("div");
let mod = document.getElementById("mod");
let clear = document.getElementById("clear");


add.addEventListener("click", async () => {
    if(num1.value.length < 1 || num2.value.length < 1){
        n1.innerHTML = "Check Numbers";
        return;
    }
    let ans = await getOpration("add", num1.value, num2.value);
    setVars(num1.value, num2.value, "+", ans);
})

sub.addEventListener("click", async () => {
    if(num1.value.length < 1 || num2.value.length < 1){
        n1.innerHTML = "Check Numbers";
        return;
    }
    let ans = await getOpration("sub", num1.value, num2.value);
    setVars(num1.value, num2.value, "-", ans);
})

mul.addEventListener("click", async () => {
    if(num1.value.length < 1 || num2.value.length < 1){
        n1.innerHTML = "Check Numbers";
        return;
    }
    let ans = await getOpration("mul", num1.value, num2.value);
    setVars(num1.value, num2.value, "*", ans);
})

div.addEventListener("click", async () => {
    if(num1.value.length < 1 || num2.value.length < 1){
        n1.innerHTML = "Check Numbers";
        return;
    }
    let ans = await getOpration("div", num1.value, num2.value);
    setVars(num1.value, num2.value, "/", ans);
})

mod.addEventListener("click", async () => {
    if(num1.value.length < 1 || num2.value.length < 1){
        n1.innerHTML = "Check Numbers";
        return;
    }
    let ans = await getOpration("mod", num1.value, num2.value);
    setVars(num1.value, num2.value, "%", ans);
})

clear.addEventListener("click", async () => {
    num1.value = "";
    num2.value = "";
    n1.innerHTML = "";
    n2.innerHTML = "";
    equal.innerHTML = ""
    op.innerHTML = "";
    ans.innerHTML = "";
})

const getOpration = async (op, number1, number2) => {
    let res = await fetch(`${URL}/${op}/${number1},${number2}`)
    let data = await res.json();
    return data
}

const setVars = (numb1, numb2, operation, answer) => {
    n1.innerHTML = numb1;
    n2.innerHTML = numb2;
    equal.innerHTML = "="
    op.innerHTML = operation;
    ans.innerHTML = answer;
}

