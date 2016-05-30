using Einsatzplanung.API.Models;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;

namespace Einsatzplanung.API.Controllers
{
    public class FachausbilderController : ApiController
    {
       [HttpPost]
       [Route("api/fachausbilder")]
       public HttpResponseMessage PostFachausbilder([FromBody] Fachausbilder fachausbilder)
        {
            using (var context = new EinsatzplanungContext())
            {
                context.Fachausbilder.Add(fachausbilder);
                context.SaveChangesAsync();
            }
            return Request.CreateResponse(HttpStatusCode.OK);
        }
        [HttpPut]
        [Route("api/fachausbilder/{id}")]
        public void UpdateFachausbilder([FromUri] int id, [FromBody] Fachausbilder newfachausbilder)
        {
            using (var context = new EinsatzplanungContext())
            {
                foreach (var fa in context.Fachausbilder)
                {
                    if(fa.FachausbilderID == id)
                    {
                        if(newfachausbilder.abteilungID != 0)
                            fa.abteilungID = newfachausbilder.abteilungID;
                        if(newfachausbilder.Nachname != null)
                            fa.Nachname = newfachausbilder.Nachname;
                        if(newfachausbilder.Vorname != null)
                            fa.Vorname = newfachausbilder.Vorname;
                        context.SaveChangesAsync();
                        break;
                    }
                }
            }
        }

        [HttpGet]
        [Route("api/fachausbilder")]
        public List<Fachausbilder> GetAllFachausbilder()
        {
            using (var context = new EinsatzplanungContext())
            {
                return context.Fachausbilder.ToList<Fachausbilder>();
            }
        }
    }
}