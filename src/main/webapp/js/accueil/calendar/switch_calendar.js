export default function switch_calendar(daily, monthly, container) {
    if (daily.classList.contains("d-active")) {
        daily.classList.replace("d-active", "d-off");
        monthly.classList.replace("m-off", "m-active");

        setTimeout(() => {
            container.classList.replace("daily-active", "monthly-active");     
        }, 1);   
    } else {
        daily.classList.replace("d-off", "d-active");
        monthly.classList.replace("m-active", "m-off");

        container.classList.replace("monthly-active", "daily-active");
    }
}