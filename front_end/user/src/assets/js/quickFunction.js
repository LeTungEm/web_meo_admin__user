const Buffer = require('buffer').Buffer;
const scrollToTop = () => {
    window.scrollTo({
        top: 0,
        behavior: "smooth",
    });
}
const scrollToMainDiv = () => {
    var targetElement = document.getElementById("mainDiv");
    targetElement.scrollIntoView({ behavior: 'smooth' });
}
const encodeEmail = (email) => {
    const encodedEmail = Buffer.from(email).toString('base64');
    return encodedEmail;
}

const decodeEmail = (encodedEmail) => {
    const decodedEmail = Buffer.from(encodedEmail, 'base64').toString('utf8');
    return decodedEmail;
}

const getCurrentTime = () => {
    let date = new Date();
    let day = date.getDate();
    day = day >= 10 ? day : `0${day}`;
    let month = date.getMonth();
    month = month >= 10 ? month : `0${month}`;
    let year = date.getFullYear();
    return `${year}-${month}-${day}`;
}

const getEmail = () => {
    let email = null;
    let userSession = sessionStorage.getItem("EMUR");
    let userLocal = localStorage.getItem("CEMURK");
    if (userSession) {
        email = userSession;
    } else if (userLocal) {
        email = userLocal;
        sessionStorage.setItem("EMUR", email);
    }
    if (email != null) {
        return decodeEmail(email);
    } else {
        return null;
    }
}

const normalizeString = (str) => {
    return str
        .toLowerCase()
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "");
}

const formatSlug = (string) => {
    let nomalString = normalizeString(string);
    return nomalString.replace(/ /g, "-");
}
export { scrollToTop, scrollToMainDiv, encodeEmail, decodeEmail, getCurrentTime, getEmail, normalizeString, formatSlug }