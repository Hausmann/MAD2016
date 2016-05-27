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
        public int GetAusbilderID([FromUri] int persNummer)
        {
            if (persNummer != 0)
            {
            using (var context = new EinsatzplanungContext())
            {
                var ausbilder = context.Ausbilder.Find(persNummer);
                if (ausbilder != null)
                    return ausbilder.AusbilderID;
                }
            }
            }
            return null;
        }
    
        [HttpPost]
        [Route("api/ausbilder")]
        public HttpResponseMessage PostAusbilder([FromBody] Ausbilder ausbilder)
        {
            if (ausbilder != null)
            {
            using (var context = new EinsatzplanungContext())
            {
                context.Ausbilder.Add(ausbilder);
                context.SaveChangesAsync();
                }
                return Request.CreateResponse(HttpStatusCode.OK);
        }
            return Request.CreateResponse(HttpStatusCode.NotFound);
        }

        [HttpPut]
        [Route("api/ausbilder/{ausbilderID}")]
        public void UpdateAusbilder([FromUri] int ausbilderid, [FromBody] Ausbilder newausbilder)
        {
            using (var context = new EinsatzplanungContext())
            {
                if (newausbilder != null)
                {
                    foreach (var ausbilder in context.Ausbilder)
                    {
                        if (ausbilder.AusbilderID == ausbilderid)
                        {
                            if (newausbilder.AbteilungID != 0)
                                ausbilder.AbteilungID = newausbilder.AbteilungID;
                            if (!string.IsNullOrEmpty(newausbilder.Nachname))
                                ausbilder.Nachname = newausbilder.Nachname;
                            if (!string.IsNullOrEmpty(newausbilder.Vorname))
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
}