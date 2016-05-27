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
            return null;
        }

        [HttpGet]
        [Route("api/azubis/{ausbilderID}")]
        public List<Azubi> GetAzubis([FromUri] int ausbilderID)
        {
            return null;
        }

        [HttpGet]
        [Route("api/abteilung/{abteilungsID}/azubis")]
        public List<Azubi> GetAbteilungsAzubis([FromUri] int abteilungsID)
        {
            return null;
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