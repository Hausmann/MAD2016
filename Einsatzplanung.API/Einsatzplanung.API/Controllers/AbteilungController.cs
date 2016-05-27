using Einsatzplanung.API.Models;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;

namespace Einsatzplanung.API.Controllers
{
    public class AbteilungController : ApiController
    {
        [HttpGet]
        [Route("api/abteilungen/")]
        public List<Abteilung> GetAbteilungen()
        {
            using (var context = new EinsatzplanungContext())
            {
                return context.Abteilung.ToList();
            }
        }

        [HttpGet]
        [Route("api/abteilung/{abteilungID}")]
        public Abteilung GetAbteilung([FromUri] int abteilungID)
        {
            using (var context = new EinsatzplanungContext())
            {
                return context.Abteilung.FirstOrDefault((a) => a.AbteilungID == abteilungID);
            }
        }

        [HttpPost]
        [Route("api/abteilung")]
        public HttpResponseMessage PostAbteilung([FromBody] Abteilung Abteilung)
        {
            using (var context = new EinsatzplanungContext())
            {
                context.Abteilung.Add(Abteilung);
                context.SaveChangesAsync();

            }
            return Request.CreateResponse(HttpStatusCode.OK);

        }

        [HttpPut]
        [Route("api/abteilung/{abteilungID}")]
        public HttpResponseMessage UpdateAbteilung([FromUri] int abteilungID, [FromBody] Abteilung newAbteilung)
        {
            using (var context = new EinsatzplanungContext())
            {
                Abteilung abteilungAusDB = context.Abteilung.Find(abteilungID);

                if (abteilungAusDB != null)
                {
                    if (newAbteilung.KOE != null)
                    {
                        abteilungAusDB.KOE = newAbteilung.KOE;
                    }
                    if (newAbteilung.Beschreibung != null)
                    {
                        abteilungAusDB.Beschreibung = newAbteilung.Beschreibung;
                    }
                    if (newAbteilung.Stellen != 0)
                    {
                        abteilungAusDB.Stellen = newAbteilung.Stellen;
                    }

                    context.SaveChangesAsync();

                    return Request.CreateResponse(HttpStatusCode.OK);
                }
                else
                {
                    return Request.CreateResponse(HttpStatusCode.NotFound);
                }
            }
        }
    }
}
