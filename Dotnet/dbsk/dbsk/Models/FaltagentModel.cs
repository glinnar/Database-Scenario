
using System.Data;
using MySql.Data.MySqlClient;



namespace dbsk.Models
{
    public class FaltagentModel
    {
        private string connectionString = "";

        public FaltagentModel(string connectionName)
        {
            connectionString = System.Configuration.ConfigurationManager.ConnectionStrings[connectionName].ConnectionString;
        }

        public DataTable GetAllFaltagent()
        {
            MySqlConnection dbcon = new MySqlConnection(connectionString);
            dbcon.Open();
            MySqlDataAdapter adapter = new MySqlDataAdapter("SELECT * FROM Faltagent;", dbcon);
            DataSet ds = new DataSet();
            adapter.Fill(ds, "result");
            DataTable FaltagentTable = ds.Tables["result"];
            dbcon.Close();
          
            return FaltagentTable;
        }
        public void DeleteFaltagent(int id)
        {
            MySqlConnection dbcon = new MySqlConnection(connectionString);
            dbcon.Open();
            string deleteString = "DELETE FROM Faltagent WHERE id=@ID;";
            MySqlCommand sqlCmd = new MySqlCommand(deleteString, dbcon);
            sqlCmd.Parameters.AddWithValue("@ID", id);
            int rows = sqlCmd.ExecuteNonQuery();
            dbcon.Close();
        }
        public DataTable SearchAgents(string Ursprungsnamn ,string Specialitet)
        {
            MySqlConnection dbcon = new MySqlConnection(connectionString);
            dbcon.Open();
            MySqlDataAdapter adapter = new MySqlDataAdapter("SELECT * FROM Faltagent WHERE Ursprungsnamn LIKE @Ursprungsnamn And Specialitet=@Specialitet ;", dbcon);
            adapter.SelectCommand.Parameters.AddWithValue("@Ursprungsnamn", "%" + Ursprungsnamn + "%");
            adapter.SelectCommand.Parameters.AddWithValue("@Specialitet", Specialitet );
            DataSet ds = new DataSet();
            adapter.Fill(ds, "result");
            DataTable FaltagentTable = ds.Tables["result"];
            dbcon.Close();
            return FaltagentTable;
        }
        public DataTable AddAgents(string Fnamn,int Fnr,string Kompetens,string Specialitet,int Antaloperationer,int Lyckadeoperationer,int Lon,string Ursprungsnamn)
        {
            MySqlConnection dbcon = new MySqlConnection(connectionString);
            dbcon.Open();
            MySqlDataAdapter adapter = new MySqlDataAdapter("INSERT INTO Faltagent (Fnamn,Fnr,Kompetens,Specialitet,Antaloperationer,Lyckadeoperationer,Lon,Ursprungsnamn) VALUES (@Fnamn,@Fnr,@Kompetens,@Specialitet,@Antaloperationer,@Lyckadeoperationer,@Lon,@Ursprungsnamn)", dbcon);
            adapter.SelectCommand.Parameters.AddWithValue("@Fnamn", Fnamn);
            adapter.SelectCommand.Parameters.AddWithValue("@Fnr", Fnr);
            adapter.SelectCommand.Parameters.AddWithValue("@Kompetens", Kompetens);
            adapter.SelectCommand.Parameters.AddWithValue("@Specialitet", Specialitet);
            adapter.SelectCommand.Parameters.AddWithValue("@Antaloperationer", Antaloperationer);
            adapter.SelectCommand.Parameters.AddWithValue("@Lyckadeoperationer", Lyckadeoperationer);
            adapter.SelectCommand.Parameters.AddWithValue("@Lon", Lon);
            adapter.SelectCommand.Parameters.AddWithValue("@Ursprungsnamn", Ursprungsnamn);
            DataSet ds = new DataSet();
            adapter.Fill(ds, "result");
            DataTable FaltagentTable = ds.Tables["result"];
            dbcon.Close();
            return FaltagentTable;
        }
    }
    }

