using Einsatzplanung.API.Models;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;


namespace Einsatzplanung.API.Controllers
{

    public class AusbilderController : ApiController
    {
        [HttpGet]
        [Route("api/ausbilder/{persNummer}")]
        public Ausbilder GetAusbilder([FromUri] int persNummer)
        {
            using (var context = new EinsatzplanungContext())
            {
                foreach (var ausbilder in context.Ausbilder)
                {
                    if (ausbilder.PersNr == persNummer)
                        return ausbilder;
                }
            }
            return null;
        }


        [HttpPost]
        [Route("api/ausbilder")]
        public HttpResponseMessage PostAusbilder([FromBody] Ausbilder ausbilder)
        {
            using (var context = new EinsatzplanungContext())
            {
                context.Ausbilder.Add(ausbilder);
                context.SaveChangesAsync();

            }

            return Request.CreateResponse(HttpStatusCode.OK);
        }

        [HttpPut]
        [Route("api/ausbilder/{ausbilderID}")]
        public void UpdateAusbilder([FromUri] int ausbilderid, [FromBody] Ausbilder newausbilder)
        {
            using (var context = new EinsatzplanungContext())
            {
                foreach (var ausbilder in context.Ausbilder)
                {
                    if (ausbilder.AusbilderID == ausbilderid)
                    {
                        if (newausbilder.AbteilungID != 0)
                            ausbilder.AbteilungID = newausbilder.AbteilungID;
                        if (newausbilder.Nachname != null)
                            ausbilder.Nachname = newausbilder.Nachname;
                        if (newausbilder.Vorname != null)
                            ausbilder.Vorname = newausbilder.Vorname;
                        if (newausbilder.PersNr != 0)
                            ausbilder.PersNr = newausbilder.PersNr;
                        context.SaveChangesAsync();
                        break;
                    }
                }
            }
        }
    }
}