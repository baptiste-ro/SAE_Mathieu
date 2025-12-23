package com.saeweb.dto.date;

import java.time.LocalDate;

public class Month {
    private LocalDate current;
    private LocalDate next;

    public Month(LocalDate date) {
        int year = date.getYear();
        int month = date.getMonthValue();
        this.current = LocalDate.parse(year + "-" + (month < 10 ? "0" + month : month) + "-01");
        this.next = LocalDate.parse(year + "-" + (month < 10 ? "0" + month : month) + "-" + date.lengthOfMonth());
    }

    public Month() {
        this.current = null;
        this.next = null;
    }

    public LocalDate getCurrent() {
        return current;
    }

    public void setCurrent(LocalDate current) {
        this.current = current;
    }

    public LocalDate getNext() {
        return next;
    }

    public void setNext(LocalDate next) {
        this.next = next;
    }

    public String toString() {
        return "{\n    current_month: " + this.current + ",\n    next: " + this.next + ",\n}";
    }
}
