package org.library.connection.db;

import org.library.exceptions.ConnectionException;
import org.library.exceptions.CustomException;
import org.library.exceptions.DMLException;
import org.library.wrappers.DataBaseWrappers;
import org.library.wrappers.TableFieldWrapper;

import java.sql.*;
import java.util.ArrayList;

/**
 * Created by sebas on 20.01.2016.
 */
public class DataBaseConnection {
    private ConnectionSettings settings;

    private Connection con;

    public DataBaseConnection() throws Exception {
        this.settings = ConnectionSettings.getConnectionSettings();
        String pathToBase = "jdbc:postgresql://" + this.settings.hostName + "/" + this.settings.dataBaseName;
        try {
            this.con = DriverManager.getConnection(pathToBase, this.settings.user, this.settings.password);
        } catch (SQLException e) {
            System.out.println(e.getMessage());
            throw new ConnectionException(e.getMessage());
        } catch (Exception e) {
            throw new CustomException(e.getMessage());
        }
    }

    public Boolean closeConnection() {
        try {
            this.con.close();
            return true;
        } catch (SQLException e) {
            System.out.println(e.getMessage());
            return false;
        }
    }

    public void insert(String tableName, ArrayList<TableFieldWrapper> values) throws Exception {
        try {
            String fields = "";
            for (TableFieldWrapper field : values) {
                fields += field.name;
            }
            String query = "INSERT INTO Biblioteka." + tableName + "(" + fields + ")"
                    + " VALUES(" + numberOfValues(values.size()) + ");";

            PreparedStatement ps = this.setQueryValues(query, values);
            ps.executeQuery();
        } catch (SQLException e) {
            System.out.println(e.getMessage());
            throw new DMLException(e.getMessage());
        } catch (Exception e) {
            System.out.println(e.getMessage());
            throw new CustomException(e.getMessage());
        }
    }

    public void delete(String tableName, TableFieldWrapper<Integer> limit) throws Exception{
        try{
            String query = "DELETE FROM " + tableName + " WHERE " + limit.name + "=?;";
            PreparedStatement ps = this.con.prepareStatement(query);
            ps.setInt(1, limit.value);
            ps.executeQuery();
        } catch (SQLException e){
            System.out.println(e.getMessage());
            throw new DMLException(e.getMessage());
        } catch (Exception e){
            System.out.println(e.getMessage());
            throw new CustomException(e.getMessage());
        }
    }

    public void update(String tableName, ArrayList<TableFieldWrapper> values,
                       TableFieldWrapper<Integer> limit) throws Exception {
        try {
            String query = "UPDATE " + tableName + " SET ";
            for (TableFieldWrapper field : values) {
                query += field.name + "=?,";
            }
            query = query.substring(0, query.length() - 1);
            query += " WHERE " + limit.name + "=?;";
            PreparedStatement ps = this.setQueryValues(query, values);
            ps.setInt(values.size() + 1, limit.value);
            ps.executeQuery();
        } catch (SQLException e) {
            System.out.println(e.getMessage());
            throw new DMLException(e.getMessage());
        } catch (Exception e) {
            System.out.println(e.getMessage());
            throw new CustomException(e.getMessage());
        }
    }

    public ResultSet select(String query) throws Exception{
        try{
            Statement st = this.con.createStatement();
            return st.executeQuery(query);
        } catch(SQLException e){
            System.out.println(e.getMessage());
            throw new CustomException(e.getMessage());
        } catch (Exception e){
            System.out.println(e.getMessage());
            throw new CustomException(e.getMessage());
        }
    }

    private String numberOfValues(Integer num) {
        String values = "";
        for (int i = 0; i < num; i++) {
            values += "?,";
        }
        return values.substring(0, values.length() - 1);
    }

    private PreparedStatement setQueryValues(String query, ArrayList<TableFieldWrapper> values) throws Exception {
        PreparedStatement ps = this.con.prepareStatement(query);
        int counter = 1;
        for (TableFieldWrapper field : values) {
            if (field.value instanceof Integer) {
                ps.setInt(counter, (Integer) field.value);
            } else if (field.value instanceof String) {
                ps.setString(counter, (String) field.value);
            } else if (field.value instanceof Double) {
                ps.setDouble(counter, (Double) field.value);
            }
            counter++;
        }
        return ps;
    }
}
