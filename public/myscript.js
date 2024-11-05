function removeRow(url, id) {
    if (confirm('Bạn có chắc chắn muốn xoá không?')) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            datatype: 'JSON',
            data: {
                id: id
            },
            url: url,
            success: function () {
                location.reload();
            }
        });
    }
}

function sharePage(url, shareType) {
    var socialShare = {
        facebook: "https://www.facebook.com/sharer/sharer.php?u=",
        linkedin: "https://www.linkedin.com/shareArticle?url=",
        instagram: "https://www.instagram.com/share?url=",
        pinterest: "https://www.pinterest.com/pin/create/button/?url=",
        skype: "https://web.skype.com/share?url=",
        telegram: "https://telegram.me/share/url?url=",
        twitter: "https://twitter.com/intent/tweet?url=",
        whatsapp: "whatsapp://send?text=",
    };
    var shareUrl = socialShare[shareType] + encodeURIComponent(url);

    var width = 600,
        height = 400;
    var top = (screen.height - height) / 2,
        left = (screen.width - width) / 2;
    window.open(shareUrl, "Chia sẻ lên mạng xã hội", "width=" + width + ", height=" + height + ", top=" + top + ", left=" + left);
}

function createSlug(str, options = {
    separate: '-',
    removeNumber: false
}) {
    if (options.removeNumber) {
        str = str.replace(/\d+/g, '');
    }

    str = str.trim().toLowerCase()
        .replace(/[;'":\\/_*.,!:=<>@#$%[\]]/g, '')
        .replace(/[áàảãạăắằẳẵặâấầẩẫậ]/gi, 'a')
        .replace(/[éèẻẽẹêếềểễệ]/gi, 'e')
        .replace(/[íìỉĩị]/gi, 'i')
        .replace(/[óòỏõọôốồổỗộơớờởỡợ]/gi, 'o')
        .replace(/[úùủũụưứừửữự]/gi, 'u')
        .replace(/[ýỳỷỹỵ]/gi, 'y')
        .replace(/[đ]/gi, 'd')
        .replace(/ /g, options.separate);

    return str.replace(
        new RegExp(`(${options.separate})+`, 'g'),
        options.separate
    );
}

function createTableOfContent(tableOfContent, ckeditorClass = '.ckeditor') {
    if (!tableOfContent) return;

    const tocList = document.createElement("ol");
    tocList.setAttribute("aria-label", "Mục lục");

    const headers = Array.from(document.querySelectorAll(`${ckeditorClass} h2, ${ckeditorClass} h3, ${ckeditorClass} h4, ${ckeditorClass} h5, ${ckeditorClass} h6`));

    const currentLists = [tocList];
    let previousLevel = 2;

    headers.forEach((heading) => {
        const level = parseInt(heading.nodeName.substring(1), 10);
        if (level > previousLevel) {
            const newList = document.createElement("ol");
            currentLists[currentLists.length - 1].lastChild.appendChild(newList);
            currentLists.push(newList);
        } else if (level < previousLevel) {
            while (level < previousLevel) {
                currentLists.pop();
                previousLevel--;
            }
        }

        const slugHeading = createSlug(heading.textContent);
        heading.id = slugHeading;

        const listItem = document.createElement("li");
        const link = document.createElement("a");
        link.href = `#${slugHeading}`;
        link.textContent = heading.textContent;
        link.rel = "nofollow";

        listItem.appendChild(link);
        currentLists[currentLists.length - 1].appendChild(listItem);

        if (level === 2) {
            link.style.fontWeight = 'bold';
        } else if (level === 3) {
            link.style.fontStyle = 'italic';
        }
        link.style.paddingLeft = 16 * (level - 2) + 'px';

        previousLevel = level;
    });

    tableOfContent.appendChild(tocList);
}

createTableOfContent(document.querySelector('#table-of-contents'));