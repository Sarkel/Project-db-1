import org.library.connection.db.DataBaseConnection;
import org.library.wrappers.TableFieldWrapper;

import java.util.ArrayList;

/**
 * Created by sebas on 20.01.2016.
 */
public class test {
    public static void main(String[] args){
        try{
            DataBaseConnection db = new DataBaseConnection();
            ArrayList<TableFieldWrapper> li = new ArrayList<>();
            li.add(new TableFieldWrapper<String>("Nazwa", "DuPA"));
            //db.insert("Rodzaj_uzytkownika", li);
            //db.update("Rodzaj_uzytkownika", li, new TableFieldWrapper<>("rodzaj_uzytkownika_id", 9));
            db.delete("Rodzaj_uzytkownika", new TableFieldWrapper<>("rodzaj_uzytkownika_id", 9));
        } catch(Exception e){
            System.out.println(e.getMessage());
        }
    }
}
