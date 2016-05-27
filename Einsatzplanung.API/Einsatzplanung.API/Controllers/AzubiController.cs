using Einsatzplanung.API.Models;
using System.Collections.Generic;
using System.Net;
using System.Net.Http;
using System.Web.Http;

namespace Einsatzplanung.API.Controllers
{
    public class AzubiController : ApiController
    {
        /*
        * GET /api/azubi/{azubiID}
        * GET /api/azubis/{ausbilderID}
        * GET /api/abteilung/{abteilungsID}/azubis
        *
        * POST /api/azubi
        */

        [HttpGet]
        [Route("api/azubi/{azubiID}")]
        public Azubi GetAzubi([FromUri] int azubiID)
        {
            using (var context = new EinsatzplanungContext())
            {
                var azubi = context.Azubis.Find(azubiID);
                if (azubi != null)
                    return azubi;
            }
            return null;
        }

        [HttpGet]
        [Route("api/azubis/{ausbilderID}")]
        public List<Azubi> GetAzubis([FromUri] int ausbilderID)
        {
            List<Azubi> listAzubisWithAusbilderID = new List<Azubi>();
            using (var context = new EinsatzplanungContext)
            {
                foreach (var azubi in context.Azubis)
                {
                    if (azubi.AusbilderID == ausbilderID)
                        listAzubisWithAusbilderID.Add(azubi);
                }
                return listAzubisWithAusbilderID;
            }
        }

        [HttpGet]
        [Route("api/abteilung/{abteilungsID}/azubis")]
        public List<Azubi> GetAbteilungsAzubis([FromUri] int abteilungsID)
        {
            List<Azubi> listAzubisMitEinsatzInAbteilung = new List<Azubi>();
            using (var context = new EinsatzplanungContext)
            {
                return null;
            }
        }

        [HttpPost]
        [Route("api/azubi")]
        public HttpResponseMessage PostAzubi([FromBody] Azubi newAzubi)
        {
            using (var context = new EinsatzplanungContext())
            {
                context.Azubis.Add(newAzubi);
                context.SaveChangesAsync();
            }
            return Request.CreateResponse(HttpStatusCode.OK);
        }
    }
}