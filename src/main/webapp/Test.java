import java.time.LocalDate;
import java.util.Date;

public class Test {
    public static void main(String[] args) {
        String str = "2024-02-23";
        LocalDate date = LocalDate.parse(str);
        LocalDate current = LocalDate.parse(date.getYear() + "-" + (date.getMonthValue() < 10 ? "0" + date.getMonthValue() : date.getMonthValue()) + "-" + "01");
        LocalDate next = LocalDate.parse(date.getYear() + "-" + (date.getMonthValue() < 10 ? "0" + date.getMonthValue() : date.getMonthValue()) + "-" + date.lengthOfMonth());
        System.out.println(current);
        System.out.println(next);
    }
}