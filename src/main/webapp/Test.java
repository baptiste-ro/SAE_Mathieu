import java.time.LocalDate;
import java.util.Date;
import java.util.UUID;

public class Test {
    public static void main(String[] args) {
        UUID uuid = UUID.randomUUID();
        System.out.println(uuid.toString() + "-" + System.currentTimeMillis());
    }
}