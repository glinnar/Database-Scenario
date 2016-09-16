using System.Web.Mvc;
using dbsk.Models;

namespace dbsk.Controllers
{
    public class HomeController : Controller
    {
        //
        // GET: /Home/
       private FaltagentModel fm = new FaltagentModel("");
       
        
        public ActionResult Index()
        {
            
            ViewBag.AllFaltagentTable = fm.GetAllFaltagent();
            return View();
        }
        //
        // GET: /Home/DeleteFaltagent/{id}

        public ActionResult DeleteFaltagent(int id)
        {
            fm.DeleteFaltagent(id);
            return RedirectToAction("Index");
        }

        public ActionResult SearchAgents(string Ursprungsnamn,string Specialitet)
        {
            ViewBag.SearchResults = fm.SearchAgents(Ursprungsnamn,Specialitet);
            return View();
        }
        public ActionResult AddAgents(string Fnamn,int Fnr,string Kompetens,string Specialitet,int Antaloperationer,int Lyckadeoperationer,int Lon,string Ursprungsnamn)
        {
            ViewBag.AddResults = fm.AddAgents(Fnamn,Fnr,Kompetens,Specialitet,Antaloperationer,Lyckadeoperationer,Lon,Ursprungsnamn);
            return RedirectToAction("Index");
        }
    }
}
