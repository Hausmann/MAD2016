using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace Einsatzplanung.WebClient.Controllers
{
    public class HomeController : Controller
    {
        public ActionResult Index()
        {
            ViewBag.Message = "Main passt sich nach Content an, mind. 200px";

            return View();
        }

        public ActionResult About()
        {
            ViewBag.Message = "Hello DATEV";

            return View();
        }

        public ActionResult Contact()
        {
            ViewBag.Message = "Your contact page.";

            return View();
        }

		public ActionResult AzubiListe()
		{
			return View();
		}
    }
}