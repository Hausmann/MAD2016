using Einsatzplanung.API.Models;
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
            if (fachausbilder != null)
            {
            using (var context = new EinsatzplanungContext())
            {
                context.Fachausbilder.Add(fachausbilder);
                context.SaveChangesAsync();
            }
            return Request.CreateResponse(HttpStatusCode.OK);
        }
            return Request.CreateResponse(HttpStatusCode.NotFound);
        }
        [HttpPut]
        [Route("api/fachausbilder/{id}")]
        public void UpdateFachausbilder([FromUri] int id, [FromBody] Fachausbilder newfachausbilder)
        {
            using (var context = new EinsatzplanungContext())
            {
                if (newfachausbilder != null)
                {
                    foreach (var fa in context.Fachausbilder)
                    {
                        if (fa.FachausbilderID == id)
                        {
                            if (newfachausbilder.abteilungID != 0)
                                fa.abteilungID = newfachausbilder.abteilungID;
                            if (string.IsNullOrEmpty(newfachausbilder.Nachname))
                                fa.Nachname = newfachausbilder.Nachname;
                            if (string.IsNullOrEmpty(newfachausbilder.Vorname))
                                fa.Vorname = newfachausbilder.Vorname;
                            if (fa.PersNr != 0)
                                fa.PersNr = newfachausbilder.PersNr;
                            context.SaveChangesAsync();
                            break;
                        }
                    }
                }
            }
    }
}
}