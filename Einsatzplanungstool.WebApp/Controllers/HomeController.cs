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

		public ActionResult AzubiListe()
		{
			return View();
		}

		public ActionResult Einsatzort()
		{
			return View();
		}

		public ActionResult Einsatz()
		{
			return View();
		}

		public ActionResult Einsatzortansicht()
		{
			return View();
		}

		public ActionResult Ausbilder()
		{
			return View();
		}

        public ActionResult AzubiEinzelAnsicht()
        {
            return View();
        }
	}
}