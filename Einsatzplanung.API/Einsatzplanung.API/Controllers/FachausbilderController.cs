using System.Web.Http;
using System.Net.Http;
using Einsatzplanung.API.Models;
using System.Net;

namespace Einsatzplanung.API.Controllers
{
    public class FachausbilderController : ApiController
    {
       [HttpPost]
       [Route("api/fachausbilder")]
       public HttpResponseMessage PostFachausbilder([FromBody] Fachausbilder fachausbilder)
        {
            return Request.CreateResponse(HttpStatusCode.OK);
        }

        
    }
}