// typing.js
window.onload = () => {
    const messageContainer = document.querySelector('.message');
    messageContainer.style.opacity = 1;

    const pTags = Array.from(messageContainer.getElementsByTagName('p'));
    let currentTagIndex = 0;

    const revealButton = document.querySelector('.yabapin_btn'); // ボタンを取得

    const typeMessage = (pTag, index = 0) => {
        const text = pTag.dataset.text;
        if (index < text.length) {
            pTag.textContent = text.substring(0, index + 1);
            setTimeout(() => typeMessage(pTag, index + 1), 100); 
        } else if (currentTagIndex < pTags.length - 1) {
            currentTagIndex += 1;
            setTimeout(() => typeMessage(pTags[currentTagIndex]), 1000);
        } else {
            if(revealButton !== null) {  // ボタンがページ上に存在する場合のみ
                revealButton.style.display = "inline-block";
                setTimeout(() => {
                    revealButton.style.opacity = "1";
                }, 500);
            }
        }
    };

    setTimeout(() => typeMessage(pTags[currentTagIndex]), 1000);
};
