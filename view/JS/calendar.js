const header = document.querySelector('.calendar h3');
const dates = document.querySelector('.dates');
const navs = document.querySelectorAll('#prev, #next');

const months = [
    "January", "February", "March", "April", "May", "June", "July", 
    "August", "September", "October", "November", "December",
];

let date = new Date(); // Để lấy ngày hiện tại
let month = date.getMonth();
let year = date.getFullYear();

function renderCalendar() {
    // Lấy ngày đầu tiên trong tháng (0 - Chủ nhật, 1 - Thứ hai, ...)
    const startDay = new Date(year, month, 1).getDay();
    
    // Số ngày trong tháng
    const endDate = new Date(year, month + 1, 0).getDate();

    // Số ngày trong tháng trước
    const endDatePrev = new Date(year, month, 0).getDate();

    let datesHtml = "";

    // Thêm các ngày của tháng trước (những ngày inactive)
    for(let i = startDay; i > 0; i--) {
        datesHtml += `<li class="inactive">${endDatePrev - i + 1}</li>`;
    }

    // Thêm các ngày của tháng hiện tại
    for(let i = 1; i <= endDate; i++) {
        let className = 
            i === date.getDate() && 
            month === new Date().getMonth() && 
            year === new Date().getFullYear()
        ? ' class="today"' : '';
        datesHtml += `<li${className}>${i}</li>`;
    }

    // Thêm các ngày "inactive" sau khi tháng hiện tại kết thúc
    const totalDays = startDay + endDate;
    const remainingDays = 7 - (totalDays % 7); // Tính số ngày còn lại trong tuần
    if (remainingDays < 7) { // Nếu vẫn còn các ngày để hoàn thành tuần
        for (let i = 1; i <= remainingDays; i++) {
            datesHtml += `<li class="inactive">${i}</li>`;
        }
    }

    // Cập nhật HTML của phần tử 'dates'
    dates.innerHTML = datesHtml;

    // Cập nhật tiêu đề tháng và năm
    header.textContent = `${months[month]} ${year}`;
}

// Thêm sự kiện cho các nút điều hướng
navs.forEach(nav => {
    nav.addEventListener('click', e => {
        const btnId = e.target.id;

        if (btnId === 'prev') {
            month--;
            if (month < 0) {
                month = 11;
                year--;
            }
        } else if (btnId === 'next') {
            month++;
            if (month > 11) {
                month = 0;
                year++;
            }
        }

        renderCalendar(); // Rerender lại calendar khi tháng/năm thay đổi
    });
});

renderCalendar(); // Khởi chạy khi trang load lần đầu

