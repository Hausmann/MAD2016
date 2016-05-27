using Einsatzplanung.API.Models;
using System.Collections.Generic;
using System.Linq;
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
                return context.Azubis.FirstOrDefault((azubi) => azubi.AzubiID == azubiID);
            }
        }

        [HttpGet]
        [Route("api/azubis/{ausbilderID}")]
        public List<Azubi> GetAzubis([FromUri] int ausbilderID)
        {
            using (var context = new EinsatzplanungContext())
            {
                for(int i = 1; i <= context.Azubis.Count(); i++)
                {
                    int count = context.Azubis.Count();
                    if (ausbilderID == context.Azubis.Find(i).AusbilderID)
                    {
                        context.Azubis.Add(context.Azubis.Find(i));
                    }
                }
                
                return context.Azubis.ToList();
            }
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
            return null;
        }
    }
}