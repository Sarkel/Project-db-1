package org.library.connection.db;

/**
 * Created by sebas on 20.01.2016.
 */
public class ConnectionSettings {
    public String user;
    public String password;
    public String dataBaseName;
    public String hostName;

    private ConnectionSettings(String user, String password, String dataBaseName, String hostName){
        this.dataBaseName = dataBaseName;
        this.hostName = hostName;
        this.password = password;
        this.user = user;
    }

    public static ConnectionSettings getConnectionSettings(){
        String user = "library_admin";
        String password = "admin";
        String dataBaseName = "library";
        String hostName = "localhost";
        return new ConnectionSettings(user, password, dataBaseName, hostName);
    }
}
